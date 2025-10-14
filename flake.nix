{
  description = "Use the devenv environemtn";

  inputs = {
    nixpkgs.url = "github:nixos/nixpkgs/nixpkgs-unstable";
    systems.url = "github:nix-systems/default";
  };

  outputs = { nixpkgs, systems, ... }: let
    forAllSystems =
      function:
      nixpkgs.lib.genAttrs (import systems) (
        system: function nixpkgs.legacyPackages.${system}
      );

  in {
    # IMPORTANT: please insert '-c $SHELL' to your command to use your environment
    devShells = forAllSystems (pkgs: {
      default = pkgs.mkShell {
        packages = [ pkgs.devenv ];
      };
    });
  };
}
